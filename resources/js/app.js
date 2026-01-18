import { createApp } from 'vue'
import Login from './components/Login.vue'
import Dashboard from './components/Dashboard.vue'
import LogoutButton from './components/LogoutButton.vue'
import '../css/custom.scss';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Login
if (document.getElementById('app')) {
	const app = createApp({})
	app.component('Login', Login)
	app.component('LogoutButton', LogoutButton)
	app.mount('#app')
}

// Dashboard
if (document.getElementById('dashboard-app')) {
	const dashboardApp = createApp(Dashboard)
	dashboardApp.component('LogoutButton', LogoutButton)
	dashboardApp.mount('#dashboard-app')
}
