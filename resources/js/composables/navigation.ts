import { router } from "@inertiajs/vue3";

export function useRelativeNavigation(baseUrl: string, path: string) {
    return navigateTo(useGetRelativeUrl(baseUrl, path));
}

export function useGetRelativeUrl(baseUrl: string, path: string) {
    const windowPath = window.location.pathname;
    const parsed = windowPath.substring(0, windowPath.lastIndexOf("/"));
    if (parsed === baseUrl) {
        const url = `${windowPath}/${trimSlashes(path)}`;
        return removeTrailingSlash(url);
    }
    return `${parsed}/${trimSlashes(path)}`;
}

function navigateTo(url: string) {
    return router.get(url);
}

function trimSlashes(input: string) {
    return input.replace(/^\/|\/$/g, "");
}

function removeTrailingSlash(input: string) {
    return input.replace(/\/$/, "");
}
