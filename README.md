
# favourites -> working
# laravel debugger
# Activity feeds
# filters
__Delete permisison__
- Deletion permission is achieved using the Laravel Policy on update function. 
```php
public function update(User $user, Article $article)
{
    return $user->articles->contains($article);
}
    
```
>Usage
`@can('update', $article) / @cannot`
- Gate is created for super Admin.
```php
Gate::before(function($user){
  return $user->id === 1 ? true : false;
});
```
>Delete associated replies

>Deletion can only be done by the creater.


