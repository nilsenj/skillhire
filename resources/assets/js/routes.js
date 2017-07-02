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
import Employers from './components/Employers/Employers.vue';
import Employees from './components/Employees/Employees.vue';

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
            children: [
                {
                    path: 'all',
                    name: 'all',
                    default: true,
                    component: AllVacancies,
                    meta: { auth: true }
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
                { path: '*', redirect: '/vacancies/all' }
            ]
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
