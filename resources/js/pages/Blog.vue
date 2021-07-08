<template>
  <div>
      <h1>My Posts</h1>

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
    methods: {
        getPosts(){

        }

    }

}
</script>

<style>
</style>
