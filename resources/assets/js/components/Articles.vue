<template>
	<div>
		<h2>Articles</h2>
		<div class="card card-body mb-2" v-for="article in articles" :key="article.id">
			<h3><a :href="'/profile/'+article.user.name">{{article.user.name}}</a> posted 
				<a :href="'article/'+article.slug">{{ article.title }}</a></h3>
			<p>{{ article.body }}</p>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return {
				articles : [],
				article:{
					id:'',
					title: '',
					body:'',
					name: ''
				},
				article_id:'',
				pagination:{},
				edit:false
			}
		},
		created(){
			this.fetchArticles();
		},
		methods:{
			fetchArticles(page_url){
				let vm = this;
				page_url = page_url || 'articles';
				fetch(page_url)
				.then(res => res.json())
				.then(res=>{
					this.articles = res.data;
					vm.makePagination(res.meta, res.links);
				})
				.catch(err => console.log(err))
			},
			makePagination(meta, links){
				let pagination = {
					current_page:meta.current_page,
				}
			}
		}
	}
</script>
