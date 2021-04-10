<template>
  <div class="Home">
    <v-main>
      <HelloWorld />
    </v-main>
  </div>
</template>

<script>
import HelloWorld from '../components/HelloWorld'

export default {
  name: 'Home',
  components: {
    HelloWorld
  }
}
</script>

<style lang="scss">
.Home {
  .v-app-bar {
    h2 {
      text-transform: uppercase;
    }
  }
}
</style>
