<template>
  <header class="bg-indigo-600 text-white p-4 flex justify-between items-center">
    <h1 class="font-bold text-xl">{{ title }}</h1>
    <button @click="logout" class="bg-red-500 px-3 py-1 rounded">Logout</button>
  </header>
</template>

<script>
import { useAuthStore } from '../store/auth';
import { useRouter } from 'vue-router';
export default {
  props: ['title'],
  setup() {
    const auth = useAuthStore();
    const router = useRouter();

    function logout() {
      auth.logout();
      router.push('/login');
    }

    return { logout };
  }
}
</script>
