<script>
import UserModal from './UserModal.vue';

export default {
  components: {
    UserModal,
  },

  data: () => ({
    users: null,
    error: null,
    selectedUser: null,
    dialog: false,
  }),

  created() {
    this.fetchUsers();
  },

  methods: {
    async fetchUsers() {
      try {
        const response = await fetch('http://localhost/users');
        if (!response.ok) throw new Error('Failed to fetch users');
        this.users = await response.json();
      } catch (err) {
        this.error = err.message;
      }
    },

    openUserModal(user) {
      this.selectedUser = user;
      this.dialog = true;
    },

    closeUserModal() {
      this.selectedUser = null;
    },
  },
};
</script>

<template>
  <div>
    <v-alert v-if="error" type="error" class="mb-4">{{ error }}</v-alert>
    <v-progress-circular v-else-if="!users" indeterminate color="primary" class="mx-auto"></v-progress-circular>
    <v-row v-else>
      <v-col
        v-for="user in users"
        :key="user.id"
        cols="12"
        sm="6"
        md="4"
        @click="openUserModal(user)"
      >
        <v-card class="hoverable">
          <v-card-title>{{ user.name }}</v-card-title>
          <v-card-subtitle>Email: {{ user.email }}</v-card-subtitle>
          <v-card-text>
            Temperature: {{ user.weather.main?.temp || 'N/A' }}°C
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <UserModal
      :user="selectedUser"
      :dialog="true"
      :close="closeUserModal"
    />
  </div>
</template>

<style scoped>
.hoverable {
  cursor: pointer;
  transition: box-shadow 0.3s;
}
.hoverable:hover {
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}
</style>