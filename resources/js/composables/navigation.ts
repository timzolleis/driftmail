import {router} from "@inertiajs/vue3";


export function useRelativeNavigation(baseUrl: string, path: string) {
    const windowPath = window.location.pathname;
    const parsed = windowPath.substring(0, windowPath.lastIndexOf('/'));
    if (parsed === baseUrl) {
        const url = `${windowPath}/${path}`;
        return router.get(removeTrailingSlash(url));
    }
    const url = `${parsed}/${path}`;
    return router.get(removeTrailingSlash(url));
}


function removeTrailingSlash(input: string) {
    return input.replace(/\/$/, "");
}
