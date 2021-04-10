<template>
  <div class="Dashboard">
    <v-main>
      <v-container>
        <v-row class="text-center">
         
        </v-row>
      </v-container>
    </v-main>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'Dashboard',
  components: {
    
  },
  computed: {
    ...mapState('User', [
      'user'
    ])
  }
}
</script>

<style lang="scss">
//.Dashboard {

//}
</style>
