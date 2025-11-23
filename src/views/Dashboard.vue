<template>
  <div class="flex">
    <Sidebar />
    <div class="flex-1">
      <Header :title="'Dashboard'" />
      <main class="p-6">
        <h2 class="text-xl font-bold mb-4">Welcome, {{ user?.name }}</h2>
        <ul>
          <li v-for="item in items" :key="item.id">{{ item.name }}</li>
        </ul>
      </main>
      <div v-for="name in names" :key="name">
        {{ name }}
        </div>
      <div v-for="actor in actors" :key="actor">
      <h3 v-if="actor.name==='bela'">{{ actor.name }}</h3>
      <ul v-for="movie in actor.movies" :key="movie">
        <li>{{ movie }}</li>
      </ul>
      
      </div>
      <div>
        <input type="text" v-model="numa">
      <input type="text" v-model="numb">
      <span>{{ sums }}</span>
      <button v-on:click="sum">add</button>
      </div>
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
    const items = ref([]);

    onMounted(async () => {
      try {
        const res = await axios.get('http://127.0.0.1:8000/api/items', {
          headers: { Authorization: 'Bearer ' + auth.token }
        });
        items.value = res.data;
      } catch (err) {
        console.error(err);
      }
    });

    return { user, items };
    },


    data() {

        return {

             sums : 0,
         numa : 0,
         numb : 0,
            names: ['abebe', 'yosef', 'yabsira'],

            actors: [
                {
                    name: 'ermias',
                    movies: ['the first', 'the lord', '79']
                },
                {
                    name: 'bela',
                    movies: ['the first', 'the lord', '79']
                },
                {
                    name: 'ermias',
                    movies: ['the first', 'the lord', '79']
                }
            ]
        }
        
    },
    methods: {
        sum() {
            this.sums =( this.numa * this.numb)
                
            }
        }

};
</script>
