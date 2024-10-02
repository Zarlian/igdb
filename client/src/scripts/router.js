import { createRouter, createWebHistory } from 'vue-router'
import { useLoggedInUserStore } from '@/scripts/stores/loggedInUser'
import HomePage from "@/components/pages/HomePage.vue";
import AdminPage from "@/components/pages/AdminPage.vue";
import WhatToPlayPage from "@/components/pages/WhatToPlayPage.vue";
import RegistrationPage from "@/components/pages/RegistrationPage.vue";
import ChartPage from "@/components/pages/ChartPage.vue";
import CalenderPage from "@/components/pages/CalenderPage.vue";
import TitlePage from "@/components/pages/TitlePage.vue";
import SignUpPage from "@/components/pages/SignUpPage.vue";
import LoginPage from "@/components/pages/LoginPage.vue";
import GameListPage from "@/components/pages/GameListPage.vue";
import RatingPage from "@/components/pages/RatingPage.vue";
import TrailerPage from "@/components/pages/TrailerPage.vue";
import TrailerGalleryPage from "@/components/pages/TrailerGalleryPage.vue";
import ScreenshotGalleryPage from "@/components/pages/ScreenshotGalleryPage.vue";

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', component: HomePage, name: 'home' },
    { path: '/admin', component: AdminPage },
    { path: '/what-to-play', component: WhatToPlayPage },
    { path: '/registration', component: RegistrationPage },
    { path: "/chart/:name", component: ChartPage, props: true },
    { path: "/calender", component: CalenderPage },
    { path: "/title/:id", component: TitlePage, props: true },
    { path: "/registration/signup", component: SignUpPage },
    { path: "/registration/login", component: LoginPage, name: 'login' },
    { path: "/profile/gamelist", component: GameListPage, name: 'gamelist' },
    { path: "/profile/ratings", component: RatingPage, name: 'ratings' },
    { path: "/trailer/:id/:index", component: TrailerPage, props: true },
    { path: "/trailer-gallery/:id", component: TrailerGalleryPage, props: true },
    { path: "/screenshots-gallery/:id/", component: ScreenshotGalleryPage, props: true },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const userStore = useLoggedInUserStore();

    if (to.path === '/admin' && !userStore.isAdmin) {

        next({ path: '/home' });
    } else {
        next();
    }
});

export default router
