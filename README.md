
# favourites -> working
# laravel debugger
# Activity feeds
# filters
##Delete permisison
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


##Favourites
__ favourites is acheived using morph to relation and used traits __

-Trait
```
trait Favouritable{

	public function favourites(){
		return $this->morphMany(Favourite::class, 'favourable');
	}

	public function getFavouritesCountAttribute(){
		return $this->favourites->count();
	}

	public function favouritable(){

		$attributes = [
			'user_id' => auth()->id()
		];

		if(!$this->favourites()->where($attributes)->exists()){			
			$this->favourites()->create($attributes);
		}
	}

	public function isFavourited(){
		return !! $this->favourites()->where('user_id', auth()->id())->count();
	}
}
```

- FAvourite controller methods
    - method to favourite comment for example
    
    
    
    ```
    public function favouriteComment(Comment $comment){

		$comment->favouritable();

		return back();

	}
    ```
