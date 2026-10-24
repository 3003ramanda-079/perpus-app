<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    book: Object,
});

const form = useForm({
    kode_buku: props.book.kode_buku,
    judul: props.book.judul,
    pengarang: props.book.pengarang,
    penerbit: props.book.penerbit ?? '',
    tahun: props.book.tahun ?? '',
    stok: props.book.stok,
});

function submit() {
    form.put(route('books.update', props.book.id));
}
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <h1>Edit Buku</h1>

            <form @submit.prevent="submit">
                <div>
                    <label>Kode Buku</label>
                    <input v-model="form.kode_buku" type="text">
                    <span v-if="form.errors.kode_buku">{{ form.errors.kode_buku }}</span>
                </div>
                <div>
                    <label>Judul</label>
                    <input v-model="form.judul" type="text">
                    <span v-if="form.errors.judul">{{ form.errors.judul }}</span>
                </div>
                <div>
                    <label>Pengarang</label>
                    <input v-model="form.pengarang" type="text">
                    <span v-if="form.errors.pengarang">{{ form.errors.pengarang }}</span>
                </div>
                <div>
                    <label>Penerbit</label>
                    <input v-model="form.penerbit" type="text">
                    <span v-if="form.errors.penerbit">{{ form.errors.penerbit }}</span>
                </div>
                <div>
                    <label>Tahun</label>
                    <input v-model="form.tahun" type="number">
                    <span v-if="form.errors.tahun">{{ form.errors.tahun }}</span>
                </div>
                <div>
                    <label>Stok</label>
                    <input v-model="form.stok" type="number">
                    <span v-if="form.errors.stok">{{ form.errors.stok }}</span>
                </div>

                <button type="submit" :disabled="form.processing">Simpan Perubahan</button>
                &nbsp;
                <Link href="/books">Batal</Link>
            </form>
        </div>
    </AuthenticatedLayout>
</template>