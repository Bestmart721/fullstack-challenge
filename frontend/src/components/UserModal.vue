<script>
export default {
  props: {
    close: Function,
    user: {
      type: Object,
      required: true,
    },
  },

  watch: {
    user: {
      immediate: true,
      handler(newVal) {
        this.dialog = !!newVal;
      },
    },
  },

  data() {
    return {
      dialog: true,
    };
  },

  methods: {
    close() {
      this.dialog = false;
    },
  },
};
</script>

<template>
  <v-dialog v-model="dialog" max-width="500px" persistent>
    <v-card>
      <v-card-title class="text-h5">{{ user.name }}</v-card-title>
      <v-card-subtitle>Email: {{ user.email }}</v-card-subtitle>
      <v-card-text>
        <p><strong>Temperature:</strong> {{ user.weather.main?.temp || 'N/A' }}°C</p>
        <p><strong>Humidity:</strong> {{ user.weather.main?.humidity || 'N/A' }}%</p>
        <p><strong>Condition:</strong> {{ user.weather.weather[0]?.description || 'N/A' }}</p>
      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" text @click="close">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>