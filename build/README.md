# Recompilar o CSS (só necessário se você mudar classes no index.php/js)

O site já vem com `css/main.css` pronto. Se editar apenas o `config/clinica.php`,
NÃO precisa recompilar nada.

Se mudar classes de layout (Tailwind) no `index.php` ou `js/app.js`:

    npm install
    npm run build

Isso regenera `css/main.css` a partir de `build/input.css`.
