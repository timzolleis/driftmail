import { router } from "@inertiajs/vue3";

export function useRelativeNavigation(baseUrl: string, path: string) {
    const windowPath = window.location.pathname;
    const testArray = windowPath.split("/");
    const parsed = windowPath.substring(0, windowPath.lastIndexOf("/"));
    if (parsed === baseUrl) {
        const url = `${windowPath}/${trimSlashes(path)}`;
        return router.get(removeTrailingSlash(url));
    }
    const url = `${parsed}/${trimSlashes(path)}`;
    console.log(trimSlashes(url));
    return router.get(removeTrailingSlash(url));
}

function trimSlashes(input: string) {
    return input.replace(/^\/|\/$/g, "");
}

function removeTrailingSlash(input: string) {
    return input.replace(/\/$/, "");
}
