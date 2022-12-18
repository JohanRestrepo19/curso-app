import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'
import ExampleComponent from './components/ExampleComponent.vue'
import BooksIndex from './components/books/BooksIndex.vue'

// Components
const app = createApp({
  components: {
    ExampleComponent,
    BooksIndex
  }
})

app.component('v-select', vSelect).mount('#app')
