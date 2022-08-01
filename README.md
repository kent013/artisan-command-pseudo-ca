# artisan-command-pseudo-ca
Artisan make command to generate usecase / request / resource classes to implement pseudo clean architecture.

This command is based on the article about **pseudo** clean architecture.

- 5年間 Laravel を使って辿り着いた，全然頑張らない「なんちゃってクリーンアーキテクチャ」という落としどころ
    - https://zenn.dev/mpyw/articles/ce7d09eb6d8117 (Japanese Only)
    - written by mpyw (https://zenn.dev/mpyw)

## Pseudo / Relaxed Clean Architecture

**pseudo** clean architecture for laravel is a relaxed domain modelling architecture which consists with `Request`, `Resource` and `Usecase`.
Again this architecture is proposed by mpyw. And I'm using this architecture in my several projects. so that I just need a class generator.

According to the article written by mpyw, `Request` is like

```php
class StoreRequest extends FormRequest
{
    public function authorize(Gate $gate): bool
    {
        $community = $this->route()->parameter('community');
	    return $gate->authorize('store', [Post::class, $community]);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:30',
            'body' => 'required|string|max:10000',
        ];
    }

    public function makePost(): Post
    {
        return new Post($this->validated());
    }
}
```

`Resource` is like

```php
class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->resource->title,
            'body' => $this->resource->body,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at, 
        ];
    }
}
```

`Usecase` is like 

```php
class StoreAction
{
    public function storeAfterDomainValidation(User $user, Community $community): self
    {
        $userPostsCountToday = $user
            ->posts()
            ->where('community_id', $community->id)
            ->where('created_at', '>=', Carbon::midnight())
            ->count();
        if ($userPostsCountToday >= 200) {
            throw new PostLimitExceededException('Exceeded');
        }
        
        $post->save();
        return $post;
    }
}
```

And controller with `Request`, `Resource` and `Usecase` goes like

```php
class PostContoller
{
    public function store(StoreRequest $request, StoreAction $action): PostResource
    {
        $post = $request->makePost();

        try {
            return new PostResource($action($user, $community, $post));
        } catch (PostLimitExceededException $e) {
            throw new TooManyRequestsHttpException(null, $e->getMessage(), $e);
        }
    }
}
```

## Installation

```
composer require --dev kent013/artisan-command-pseudo-ca
```

## Generate config file

```
php artisan vendor:publish --tag="pseudoca"
```

## Configuration

```
PSEUDOCA_USECASE_NS="\UseCases"
PSEUDOCA_REQUEST_NS="\Http\Requests"
PSEUDOCA_RESOURCE_NS="\Http\Resources"
```

If you want to change namespaces, please add above lines in your `.env` file and change values.

## Generate Usecase

```
php artisan make:pseudoca:usecase LoginAction
```

will generates `LoginAction` class under root namespace suffixed with `PSEUDOCA_USECASE_NS`. Default namespace is `\UseCase`.


## Generate Request

```
php artisan make:pseudoca:request LoginRequest
```

will generates `LoginRequest` class under root namespace suffixed with `PSEUDOCA_REQUEST_NS`. Default namespace is `\Http\Requests`.


## Generate Resource

```
php artisan make:pseudoca:resource LoginResource
```

will generates `LoginResource` class under root namespace suffixed with `PSEUDOCA_RESOURCE_NS`. Default namespace is `\Http\Resources`.


### Generate PseudoCA classes at once

```
php artisan make:pseudoca Login
```

will generates `LoginResource`, `LoginRequest` and `LoginUsecase`.