import { clsx } from "clsx";
import { twMerge } from "tailwind-merge";

export function cn(...inputs) {
    return twMerge(clsx(inputs));
}

export function timeAgo(date, i18n) {
    const now = new Date();
    const past = new Date(date);
    const secondsAgo = Math.floor((now - past) / 1000);

    if (secondsAgo < 60) {
        return i18n.t('timeAgo.second', { count: secondsAgo });
    }

    const minutesAgo = Math.floor(secondsAgo / 60);
    if (minutesAgo < 60) {
        return i18n.t('timeAgo.minute', { count: minutesAgo });
    }

    const hoursAgo = Math.floor(minutesAgo / 60);
    if (hoursAgo < 24) {
        return i18n.t('timeAgo.hour', { count: hoursAgo });
    }

    const daysAgo = Math.floor(hoursAgo / 24);
    if (daysAgo < 30) {
        return i18n.t('timeAgo.day', { count: daysAgo });
    }

    const monthsAgo = Math.floor(daysAgo / 30);
    if (monthsAgo < 12) {
        return i18n.t('timeAgo.month', { count: monthsAgo });
    }

    const yearsAgo = Math.floor(monthsAgo / 12);
    return i18n.t('timeAgo.year', { count: yearsAgo });
}
