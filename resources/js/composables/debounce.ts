export function useDebounce() {
    let timeout: number | undefined = undefined;
    return function (fnc: Function, delayMs: number) {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            fnc();
        }, delayMs || 500);
    };
}
