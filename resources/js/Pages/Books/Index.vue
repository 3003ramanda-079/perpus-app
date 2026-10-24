<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    books: Object,
    search: String,
});

const keyword = ref(props.search || '');

function cari() {
    router.get('/books', {
        search: keyword.value
    });
}

function hapus(id) {
    if (confirm('Yakin ingin menghapus buku ini?')) {
        router.delete(route('books.destroy', id));
    }
}
</script>

<template>
    <AuthenticatedLayout>

        <div>
            <h1>Data Buku</h1>

            <!-- Flash Message -->
            <div v-if="$page.props.flash?.success">
                {{ $page.props.flash.success }}
            </div>

            <br>

            <!-- Tombol Tambah -->
            <Link href="/books/create">
                + Tambah Buku
            </Link>

            <br><br>

            <!-- Pencarian -->
            <input
                v-model="keyword"
                @keyup.enter="cari"
                type="text"
                placeholder="Cari judul atau pengarang..."
            >

            <button @click="cari">
                Cari
            </button>

            <br><br>

            <!-- Tabel Buku -->
            <table border="1" cellpadding="10" cellspacing="0">

                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr v-if="books.data.length === 0">
                        <td colspan="7">Belum ada data buku.</td>
                    </tr>

                    <tr
                        v-for="book in books.data"
                        :key="book.id"
                    >
                        <td>{{ book.kode_buku }}</td>
                        <td>{{ book.judul }}</td>
                        <td>{{ book.pengarang }}</td>
                        <td>{{ book.penerbit }}</td>
                        <td>{{ book.tahun }}</td>
                        <td>{{ book.stok }}</td>

                        <td>
                            <Link :href="`/books/${book.id}/edit`">
                                Edit
                            </Link>

                            &nbsp;

                            <button @click="hapus(book.id)">
                                Hapus
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

            <br>

            <!-- Informasi jumlah data -->
            <div>
                Menampilkan
                {{ books.from ?? 0 }}
                sampai
                {{ books.to ?? 0 }}
                dari
                {{ books.total }}
                buku.
            </div>

            <br>

            <!-- Paginasi -->
            <div>
                <template v-for="link in books.links" :key="link.label">
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        v-html="link.label"
                        :style="{ fontWeight: link.active ? 'bold' : 'normal', marginRight: '8px' }"
                    />
                    <span
                        v-else
                        v-html="link.label"
                        style="margin-right: 8px; color: gray;"
                    />
                </template>
            </div>

        </div>

    </AuthenticatedLayout>
</template>