import {router} from "@inertiajs/vue3";

export function useRelativeNavigation(baseUrl: string, path: string) {
    return navigateTo(useDynamicUrl(baseUrl, path));
}

export function useGetRelativeUrl(baseUrl: string, path: string, preserveOptionalParameters: number = 0) {
    const windowPath = trimSlashes(window.location.pathname);
    let parsed = windowPath.substring(0, windowPath.lastIndexOf("/"));
    if (parsed === baseUrl) {
        const url = `${windowPath}/${trimSlashes(path)}`;
        return removeTrailingSlash(url);
    }
    return `${parsed}/${trimSlashes(path)}`;
}


export function useDynamicUrl(base: string, path: string) {
    const windowPath = trimSlashes(window.location.pathname);
    const split = windowPath.split("/")
    const lastIndex = findCurlyBracesIndex(trimSlashes(base))
    const slicedWindowUrl = split.slice(0, (lastIndex ? lastIndex + 1 : 0))
    const joinedWindowUrl = slicedWindowUrl.join("/")
    return `/${joinedWindowUrl}/${trimSlashes(path)}`
}

export function useNegativeNavigation(delta: number) {
    const url = trimSlashes(window.location.pathname)
    const parts = url.split("/").slice(0, -delta)
    return "/" +
        parts.join('/').trim()
}


function findCurlyBracesIndex(str: string): number | undefined {
    const parts = str.split("/");
    let lastFoundIndex = undefined
    parts.forEach((part, index) => {
        if (/\{.*\}/.test(part)) {
            lastFoundIndex = index
        }
    })
    return lastFoundIndex
}

export function getParametersFromRoute(parameterString: string) {
    const url = window.location.pathname
    const elements = parameterString.split('/')
    const parameters = elements.map((element, index) => {
        if (element.includes("$")) {
            const parameterName = element.split("$")[1]
            const parameterValue = url.split("/")[index]
            return {[parameterName]: parameterValue}
        }
    }).filter(element => element) as { [key: string]: string }[]
    return parameters.reduce((previousValue, currentValue, currentIndex, array) => {
        const key = Object.keys(currentValue)[0]
        previousValue[key] = currentValue[key]
        return previousValue;
    }, {})
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
