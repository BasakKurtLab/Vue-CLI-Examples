<template>
  <div id="app">
    <div id="nav" class="wrapper">
      <router-link to="/">Home</router-link>
      <router-link to="/user/max_muster25">Max's Profil ansehen</router-link>
    </div>
    <main>
      <router-view/>
    </main>
  </div>
</template>



<style>

.wrapper
{
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
}

</style>
