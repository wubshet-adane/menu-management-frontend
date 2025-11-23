<template>
  <div class="flex">
    <Sidebar />
    <div class="flex-1">
      <Header :title="'Dashboard'" />
      <main class="p-6">
        <h2 class="text-xl font-bold mb-4">Welcome, {{ user.name }}</h2>
        <p class="text-balance font-stretch-95% font-bold" >email: {{ user.email }}</p>
        <h2 class="text-balance font-stretch-95% font-bold">Slug: {{ user.slug }}</h2>
        <h1 class="text-info font-bold" >business-name: {{ user.business_name }}</h1>
        <h1 class="text-warning font-bold" >phone: {{ user.phone }}</h1>
        <div class="mt-6">
          <h3 class="text-lg font-semibold mb-2">categories</h3>
          <ul>
            <li v-for="item in categories" :key="item.id" class="border-b py-2">
              {{ item.name }} - {{ item.description }}
            </li>
          </ul>
        </div>
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Counter</h3>
            <p class="text-2xl mb-4">{{ count }}</p>
            <button @click="increment" class=" cursor-pointer bg-green-500 text-white px-4 py-2 rounded">
                Increment Counter
            </button>
            <button @click="count = 0" class=" cursor-pointer bg-red-500 text-white px-4 py-2 rounded ml-2">
                Reset Counter
            </button>
            <input class="mt-4" v-model="count" type="number" />
        </div>
      </main>
      
    </div>
  </div>
</template>

<script>
import Header from '../components/Header.vue';
import Sidebar from '../components/Sidebar.vue';
import axios from 'axios';
import { useAuthStore } from '../store/auth';
import { ref, onMounted } from 'vue';

export default {
  components: { Header, Sidebar },
  setup() {
    const auth = useAuthStore();
    const user = auth.user;
    const categories = ref([]);

    onMounted(async () => {
      try {
        const res = await axios.get('http://127.0.0.1:8000/api/categories', {
          headers: { Authorization: 'Bearer ' + auth.token }
        });
        categories.value = res.data;
      } catch (err) {
        console.error(err);
      }
    });

    return { user, categories };
    },


    data() {

      return {
          count : 0,
        }
        
    },
    methods: {
        increment() {
            this.count += 1;
        }
    }

};
</script>
