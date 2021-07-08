<template>
  <div>
      <h1>Il mio Blog</h1>
      <div>

            <!-- loader -->
            <div v-if="!loaded" class="text-center mt-5">
                <div class="lds-heart"><div></div></div>
            </div>


        <!-- wrapper posts -->
        <div v-if="loaded">


            <!-- lista posts -->
            <div
            v-for="post in posts"
            :key="'p'+post.id"
            class="card mb-3" >

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <span class="badge badge-success custom-badge">{{ post.category }}</span>
                    </div>
                    <i>{{ formatDate(post.date) }}</i>
                    <p class="card-text">{{ post.content }}</p>
                    <a href="#" class="btn btn-primary">Vai</a>
                </div>

            </div>

            <!-- paginazione -->
            <div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li
                        :class="{'disabled': pagination.current === 1}"
                        class="page-item">
                            <button
                            @click="getPosts(pagination.current - 1)"
                            class="page-link" >&laquo;</button>
                        </li>

                        <li
                        v-for="i in pagination.last"
                        :key="'i'+i"
                        :class="{'active' : pagination.current === i}"
                        class="page-item">
                            <button
                            @click="getPosts(i)"
                             class="page-link">{{ i }}</button></li>


                        <li
                        :class="{'disabled': pagination.current === pagination.last}"
                        class="page-item">
                            <button
                            @click="getPosts(pagination.current + 1)"
                            class="page-link" >&raquo;</button>
                        </li>
                    </ul>
                </nav>
            </div>

            </div>
            <!-- end wrapper posts -->



      </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'Blog',
    data(){
        return{
            posts: [],
            pagination: {},
            loaded: false
        }
    },
    methods:{
        getPosts(page = 1){
            this.loaded = false;
            axios.get('http://127.0.0.1:8000/api/posts',{
                params:{
                    page: page
                }
            })
                .then(res => {
                    console.log(res.data.data);
                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page
                    }
                    this.loaded = true;
                })
                .catch(err => {
                    console.log(err);
                })
        },
        formatDate(date){
            let d = new Date(date);
            let dy = d.getDate();
            let m = d.getMonth() + 1;
            let y = d.getFullYear();
            if(dy < 10) dy = '0' + dy;
            if(m < 10) m = '0' + m;
            return `${dy}/${m}/${y}`;
        }
    },
    created(){
        this.getPosts();
    }
}
</script>

<style lang="scss" scoped>
.custom-badge{
    display: inline-block;
    height: 2rem;
    line-height: 2rem;
}
.lds-heart {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
  transform: rotate(45deg);
  transform-origin: 40px 40px;
}
.lds-heart div {
  top: 32px;
  left: 32px;
  position: absolute;
  width: 32px;
  height: 32px;
  background: red;
  animation: lds-heart 1.2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
}
.lds-heart div:after,
.lds-heart div:before {
  content: " ";
  position: absolute;
  display: block;
  width: 32px;
  height: 32px;
  background: red;
}
.lds-heart div:before {
  left: -24px;
  border-radius: 50% 0 0 50%;
}
.lds-heart div:after {
  top: -24px;
  border-radius: 50% 50% 0 0;
}
@keyframes lds-heart {
  0% {
    transform: scale(0.95);
  }
  5% {
    transform: scale(1.1);
  }
  39% {
    transform: scale(0.85);
  }
  45% {
    transform: scale(1);
  }
  60% {
    transform: scale(0.95);
  }
  100% {
    transform: scale(0.9);
  }
}
</style>
