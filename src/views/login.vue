<template>
  <div class="max-w-md mx-auto mt-20 p-6 border rounded shadow">
    <h2 class="text-xl font-bold mb-4">Login</h2>
    <input v-model="email" type="email" placeholder="Email" class="border p-2 mb-3 w-full"/>
    <input v-model="password" type="password" placeholder="Password" class="border p-2 mb-3 w-full"/>
    <button @click="login" class="bg-indigo-600 text-white px-4 py-2 w-full rounded">Login</button>
  </div>
</template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../store/auth';
import { ref } from 'vue';

export default {
  setup() {
    const email = ref('');
    const password = ref('');
    const router = useRouter();
    const auth = useAuthStore();

    const login = async () => {
      try {
        const res = await axios.post('http://127.0.0.1:8000/api/service-providers/login', {
          email: email.value,
          password: password.value
        });
        auth.setToken(res.data.token);
        auth.setUser(res.data.user);
        router.push('/dashboard');
      } catch (err) {
        alert('Login failed');
        console.error(err);
      }
    };

    return { email, password, login };
  }
};
</script>
