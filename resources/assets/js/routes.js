import VueRouter from 'vue-router';
import Home from './components/Home.vue';
import Register from './components/Auth/Register.vue';
import Signin from './components/Auth/Signin.vue';
import Profile from './components/User/Profile.vue';
import Skills from './components/User/Skills.vue';
import Contact from './components/User/Contacts.vue';
import Account from './components/User/Account.vue';
import AdditionalSettings from './components/User/AdditionalSettings.vue';
import MainVacancy from './components/Vacancy/Main.vue';
import AllVacancies from './components/Vacancy/All.vue';
import VacanciesByProfile from './components/Vacancy/Bymyprofile.vue';
import Vacancy from './components/Vacancy/Vacancy.vue';
import VacancyLocationFilter from './components/Vacancy/LocationFilter.vue';
import VacancyVariantFilter from './components/Vacancy/VariantsFilter.vue';
import VacancyTrendFilter from './components/Vacancy/TrendFilter.vue';
import Employers from './components/Employers/Employers.vue';
import Employees from './components/Employees/Employees.vue';
import MainAdmin from './components/Admin/Main.vue';
import auth from './services/auth.service.js';

export var router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/signin',
            name: 'signin',
            component: Signin
        },
        {
            path: '/account',
            name: 'account',
            component: Account,
            props: { auth: auth },
            children: [
                {
                    path: 'profile',
                    name: 'profile',
                    component: Profile,
                    meta: { auth: true }
                },
                {
                    path: 'skills',
                    name: 'skills',
                    component: Skills,
                    meta: { auth: true }
                },
                {
                    path: 'contact',
                    name: 'contact',
                    component: Contact,
                    meta: { auth: true }
                },
                {
                    path: 'additional_settings',
                    name: 'additional_settings',
                    component: AdditionalSettings,
                    meta: { auth: true }
                },
            ]
        },
        {
            path: '/vacancies',
            name: 'vacancies',
            component: MainVacancy,
            meta: { auth: true },
            props: { default: true },
            children: [
                {
                    path: 'all',
                    name: 'all',
                    default: true,
                    component: AllVacancies,
                    meta: { auth: true },
                },
                {
                    path: 'bymyprofile',
                    name: 'bymyprofile',
                    component: VacanciesByProfile,
                    meta: { auth: true }
                },
                {   path: ':vacancyId',
                    name: 'vacancy',
                    component: Vacancy,
                    props: true,
                    meta: { auth: true }
                },
                {   path: 'location/:location',
                    name: 'location',
                    component: VacancyLocationFilter,
                    props: true,
                    meta: { auth: true }
                },
                {   path: 'trend/:trend',
                    name: 'trend',
                    component: VacancyTrendFilter,
                    props: true,
                    meta: { auth: true }
                },
                {   path: 'variant/:variant',
                    name: 'variant',
                    component: VacancyVariantFilter,
                    props: true,
                    meta: { auth: true }
                },
                { path: '*', redirect: '/vacancies/all' }
            ]
        },
        {
            path: '/admin',
            name: 'admin',
            component: MainAdmin,
            meta: { auth: true, isAdmin: true },
            props: { auth: auth },
            children: []
        },
        {
            path: '/employers',
            name: 'employers',
            component: Employers,
            meta: { auth: true }
        },
        {
            path: '/employees',
            name: 'employees',
            component: Employees,
            meta: { auth: true }
        }
    ]
});
