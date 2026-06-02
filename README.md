<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# Loja do Zeca

Projeto Laravel 12 para gerenciamento de materiais de constru��o, com cadastro de categorias, cadastro de materiais, upload de imagens e controle visual de estoque.

> Projeto desenvolvido por Henry Domingues.

## Descri��o

Loja do Zeca � uma aplica��o web constru�da em Laravel 12 que oferece:

- CRUD completo para categorias e materiais
- Upload de imagem para cada material
- Detec��o de imagens muito grandes com aviso no formul�rio
- Aviso visual em vermelho quando o estoque est� abaixo do m�nimo
- Aviso visual em amarelo quando o estoque est� exatamente no m�nimo
- Exibi��o de materiais em cards com todos os campos importantes
- Exibi��o de "N�o se aplica" quando a validade estiver em branco

## Vers�es utilizadas

### Backend
- PHP `^8.2`
- Laravel `^12.0`
- Laravel Breeze `^2.4`
- Laravel Tinker `^2.10.1`

### Frontend
- Node.js: recomendado `>=18`
- Vite `^7.0.7`
- Tailwind CSS `^3.1.0`
- Alpine.js `^3.4.2`
- Axios `^1.11.0`
- @tailwindcss/forms `^0.5.2`
- laravel-vite-plugin `^2.0.0`

## Requisitos

- PHP `8.2` ou superior
- Composer
- Node.js `>=18`
- npm
- Servidor web local (XAMPP, Laravel Sail, Valet, etc.)

## Instala��o passo a passo

1. Acesse a pasta do projeto:

```bash
cd c:\xampp\htdocs\loja-do-zeca
```

2. Instale as depend�ncias PHP:

```bash
composer install
```

3. Instale as depend�ncias JavaScript:

```bash
npm install
```

4. Copie o arquivo de ambiente:

```bash
copy .env.example .env
```

5. Gere a chave da aplica��o:

```bash
php artisan key:generate
```

6. Configure o banco de dados no arquivo `.env`.

7. Execute as migrations:

```bash
php artisan migrate
```

8. Crie o link simb�lico para storage:

```bash
php artisan storage:link
```

9. Inicie o servidor de desenvolvimento:

```bash
php artisan serve
```

10. Inicie o servidor de assets:

```bash
npm run dev
```

11. Abra a aplica��o em:

```text
http://127.0.0.1:8000
```

## Comandos �teis

- Rodar testes:

```bash
php artisan test
```

- Compilar assets para produ��o:

```bash
npm run build
```

- Limpar cache de views:

```bash
php artisan view:clear
```

## Observa��es

- As imagens de materiais s�o armazenadas em `storage/app/public/materiais`.
- O projeto j� cont�m l�gica para exibir avisos de estoque baixo e de estoque no m�nimo.
- Quando o campo `data_validade` est� vazio, a interface mostra `N�o se aplica`.

## Autor

Henry Domingues

---

Documenta��o criada para orientar a instala��o e uso do projeto Loja do Zeca, respeitando as vers�es notificadas em `composer.json` e `package.json`.
