export const checkDarkMode = (): void => {
    if (localStorage.getItem('color-theme') === 'dark' || (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches))
    {
        console.log('adding dark mode');
        document.documentElement.classList.add('dark')
    }
    else {
        console.log('removing dark mode');}
        document.documentElement.classList.remove('dark')
}