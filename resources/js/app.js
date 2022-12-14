import './bootstrap'
import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue'

// Components
const app = createApp({
	components: {
		ExampleComponent
	}
})

app.mount('#app')
