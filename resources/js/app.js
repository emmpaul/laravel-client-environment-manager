import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { createI18n } from 'vue-i18n'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const browserLocale = navigator.language.split('-')[0]

const i18n = createI18n({
    locale: browserLocale,
    fallbackLocale: 'en',
    messages: {
        fr: {
            login: 'Connexion',
            register: 'S\'inscrire',
            cancel: {
                label: 'Annuler',
            },
            edit: {
                title: 'Modifier {name}',
                informations: 'Modifier les informations',
            },
            delete: {
                label: 'Supprimer {name}',
                areYouSure: 'Êtes-vous sûr de vouloir supprimer {name} ?',
                cannotBeUndone: 'Cette action ne peut pas être annulée.',
            },
            theme: {
                light: 'Clair',
                dark: 'Sombre',
                system: 'Système',
            },
            dashboard: {
                title: 'Tableau de bord',
                clientsAddedThisYear: 'Clients ajoutés cette année',
            },
            clients: {
                title: 'Clients',
                mustBeLoggedIn: 'Pour modifier cette application, vous devez être connecté.',
                noInformationsFound: 'Aucune information trouvée',
                lastUpdated: 'Dernière mise à jour ',
                visit: 'Visiter',
            },
            informations: {
                add: 'Ajouter des informations pour {name}',
            },
            search: {
                title: 'Recherche',
                noQuery: 'Commencez à taper pour rechercher des clients ou des informations.',
                noClientsFound: 'Aucun client trouvé pour ',
            },
            timeAgo: {
                second: 'Il y a 1 seconde',
                seconds: 'Il y a {count} secondes',
                minute: 'Il y a 1 minute',
                minutes: 'Il y a {count} minutes',
                hour: 'Il y a 1 heure',
                hours: 'Il y a {count} heures',
                day: 'Il y a 1 jour',
                days: 'Il y a {count} jours',
                month: 'Il y a 1 mois',
                months: 'Il y a {count} mois',
                year: 'Il y a 1 an',
                years: 'Il y a {count} ans',
            }
        },
        en: {
            login: 'Login',
            register: 'Register',
            cancel: {
                label: 'Cancel',
            },
            edit: {
                title: 'Edit {name}',
                informations: 'Edit informations',
            },
            delete: {
                label: 'Delete {name}',
                areYouSure: 'Are you sure you want to delete {name} ?',
                cannotBeUndone: 'This action cannot be undone.',
            },
            theme: {
                light: 'Light',
                dark: 'Dark',
                system: 'System',
            },
            dashboard: {
                title: 'Dashboard',
                clientsAddedThisYear: 'Clients added this year',
            },
            clients: {
                title: 'Clients',
                mustBeLoggedIn: 'To make modifications to this app, you need to be logged in.',
                noInformationsFound: 'No informations found',
                lastUpdated: 'Last updated ',
                visit: 'Visit',
            },
            informations: {
                add: 'Add informations for {name}',
            },
            search: {
                title: 'Search',
                noQuery: 'Start typing to search for clients or informations.',
                noClientsFound: 'No clients found for ',
            },
            timeAgo: {
                second: '1 second ago',
                seconds: '{count} seconds ago',
                minute: '1 minute ago',
                minutes: '{count} minutes ago',
                hour: '1 hour ago',
                hours: '{count} hours ago',
                day: '1 day ago',
                days: '{count} days ago',
                month: '1 month ago',
                months: '{count} months ago',
                year: '1 year ago',
                years: '{count} years ago',
            }
        }
    }
})

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(i18n)
            .mount(el);
    },
    progress: {
        delay: 250,

        color: '#f97316',

        includeCSS: true,

        showSpinner: false,
    },
});
