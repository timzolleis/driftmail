export function useApiKey() {
    const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!';
    let result = "";

    for (let i = 0; i < 40; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;

}
