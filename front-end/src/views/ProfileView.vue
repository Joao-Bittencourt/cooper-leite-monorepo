<template>
    <content-header title="Perfil" />
    <content>
        <div class="card">
            <div class="card-header">Usuário</div>
            <div class="card-body">
                <div v-if="user">
                    <p><strong>ID:</strong> {{ user.id }}</p>
                    <p><strong>Nome:</strong> {{ user.name }}</p>
                    <p><strong>Email:</strong> {{ user.email }}</p>
                    <p><strong>Verificado:</strong> {{ user.email_verified_at ? 'Sim' : 'Não' }}</p>
                    <p><strong>Criado em:</strong> {{ formatDate(user.created_at) }}</p>
                    <p><strong>Atualizado em:</strong> {{ formatDate(user.updated_at) }}</p>
                </div>
            </div>
        </div>
    </content>
</template>

<script>
import { getUser } from '../services/UserService.js';

export default {
    data() {
        return {
            user: null,
        }
    }, methods: {
        async fetchData() {
            const response = getUser();
            const data = await response;
            this.user = data;
        },
        formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return new Date(dateString).toLocaleDateString('pt-BR', options);
        },
    },
    created() {
        this.fetchData();
    }
}
</script>