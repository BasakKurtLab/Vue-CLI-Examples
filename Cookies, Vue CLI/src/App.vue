<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link>
    </div>
    
    <router-view />
  </div>
</template>

<style>

*{box-sizing: border-box;font-family: "segoe ui";}
body
{
  margin: 0;
  background-color: #e6e6e6;
}

.wrapper
{
  max-width: 900px;
  margin-left: auto;
  margin-right: auto;
}
.container
{
    background-color: white;
    padding: 25px;
    border-radius: 8px;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>

<script>

export default {
}

</script>