### Article forum with TDD. Started with Brad's (laravel with vue demonstration) blog repo and ended up doing TDD in the same repository and made it into a forum. 


#### Table of contents
[Delete permission](#delete_permission)


[Favourites with morph](#favourites)

[Activity Feeds with laravel event listeners](#activity_feeds)


## Laravel debugger
## Filters


<a name="delete_permission"/>


## Permisison

>This demonstrates the use of laravel policies.


- Permisisons are achieve using laravel policies.Defined permisison on update. 
```php
public function update(User $user, Article $article)
{
    return $user->articles->contains($article);
}
    
```
>Usage
`@can('update', $article) / @cannot`
- Gate is created for super Admin giving access to do anything on the forum.
```php
Gate::before(function($user){
  return $user->id === 1 ? true : false;
});
```


<a name="favourites">
	
	
## Favourites

> A user can favourite articles & comments so need to have a `favourites` table with `polymorphic` relation.
> Favourites is acheived using morph to relation and used traits since we can favourite both articles and comments.

- Trait

```php
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
	
	/* This function checks if the given model instance is already favourited or not */
	public function isFavourited(){ 
		return !! $this->favourites()->where('user_id', auth()->id())->count();
	}
}
```

- Favourite controller methods
    - method to favourite comment for example    
    
    
    ```php
    public function favouriteComment(Comment $comment){

		$comment->favouritable();

		return back();

	}
    ```
    
<a name="activity_feeds">
	
	
## Activity Feeds

> Activity feeds records the CRUD's changes made to the database by the users.


* When user make changes to the `articles` table an activity is recorded *
we have created a polymorphic relation here as well inorder to record the activities to various tables

```php
public function activityLogs(){

    return $this->morphMany(Activity::class,'subject','subject','subject_id');

}
```

__ Activity is recorded as __
```php
public function recordActivity(){

	$this->activityLogs()->create([

		'type'	=> 'created_article',
		'user_id'	=> auth()->id()

	]);

}
```

__ on boot method __ 


```php
static::created(function($model){

	$model->recordActivity();

});
```
