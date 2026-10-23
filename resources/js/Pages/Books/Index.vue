<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    books: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <h1>Data Buku</h1>
        <Link href="/books/create">+ Tambah Buku</Link>

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books.data" :key="book.id">
                    <td>{{ book.kode_buku }}</td>
                    <td>{{ book.judul }}</td>
                    <td>{{ book.pengarang }}</td>
                    <td>{{ book.stok }}</td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>
```[cite: 8, 9]

### 4. Bersihkan Cache Laravel
Jika kedua terminal sudah aktif dan kode sudah benar, jalankan perintah ini di terminal untuk membersihkan cache yang mungkin masih nyangkut:
```bash
php artisan optimize:clear