*Passo a passo para usar o projeto*

#Instalar bd sqlite
touch database/database.sqlite

#Alterar no .env
DB_CONNECTION=sqlite

#Instalar o composer e dependencias
composer require filament/filament:"^3.2" livewire/livewire
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p