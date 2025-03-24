<template>
  <v-app>
    <v-container>
      <h1 class="text-center mb-6">User Weather Dashboard</h1>
      <ApiTest />
    </v-container>
  </v-app>
</template>

<script>
import ApiTest from './components/ApiTest.vue';

export default {
  components: {
    ApiTest,
  },
};
</script>