<script setup lang="ts">
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import PasswordController from '@/actions/App/Http/Controllers/Settings/PasswordController';
import DeleteUser from '@/components/DeleteUser.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import AppearanceTabs from '@/components/AppearanceTabs.vue';
import TwoFactorRecoveryCodes from '@/components/TwoFactorRecoveryCodes.vue';
import TwoFactorSetupModal from '@/components/TwoFactorSetupModal.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Separator } from '@/components/ui/separator';
import { Badge } from '@/components/ui/badge';
import { Form, Link, usePage } from '@inertiajs/vue3';
import { ref, onUnmounted } from 'vue';
import { User, Lock, ShieldCheck, Monitor, ShieldBan } from 'lucide-vue-next';
import { useTwoFactorAuth } from '@/composables/useTwoFactorAuth';
import { disable, enable } from '@/routes/two-factor';
import { computed } from 'vue';

const props = withDefaults(defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
    twoFactorEnabled?: boolean;
    requiresConfirmation?: boolean;
}>(), {
    requiresConfirmation: false,
    twoFactorEnabled: false,
});

const page = usePage();
const user = page.props.auth.user;
const userRole = computed(() => (page.props as any).auth?.user?.role ?? null);
const isUser = computed(() => userRole.value === 'user');
const isAdmin = computed(() => userRole.value === 'admin');

// Controle de Abas
const currentTab = ref('profile');

const tabs = [
    { id: 'profile', label: 'Perfil', icon: User },
    { id: 'password', label: 'Senha', icon: Lock },
    { id: '2fa', label: 'Autenticação 2FA', icon: ShieldCheck },
    { id: 'appearance', label: 'Aparência', icon: Monitor },
];

// Lógica de 2FA
const { hasSetupData, clearTwoFactorAuthData } = useTwoFactorAuth();
const showSetupModal = ref(false);

onUnmounted(() => {
    clearTwoFactorAuthData();
});


</script>

<template>
    <div class="px-4 py-6 max-w-7xl mx-auto mt-15">
        <!-- Cabeçalho -->
        <div class="mb-8">
            <Heading
                title="Configurações"
                description="Gerencie seu perfil e as configurações da conta"
            />
            <div class="pt-2">
                 <Link href="/admin" class="text-sm text-muted-foreground hover:underline" v-if="isAdmin">
                    &larr; Voltar ao Painel Admin
                 </Link>
                 <Link href="/tickets/user" class="text-sm text-muted-foreground hover:underline" v-if="isUser">
                    &larr; Voltar ao Painel
                 </Link>
                 
            </div>
        </div>

        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <!-- Barra Lateral de Navegação (Abas) -->
            <aside class="w-full max-w-xl lg:w-48 mb-6 lg:mb-0">
                <nav class="flex flex-col space-y-1">
                    <Button
                        v-for="tab in tabs"
                        :key="tab.id"
                        variant="ghost"
                        :class="[
                            'w-full justify-start',
                            { 'bg-muted': currentTab === tab.id }
                        ]"
                        @click="currentTab = tab.id"
                    >
                        <component :is="tab.icon" class="mr-2 h-4 w-4" />
                        {{ tab.label }}
                    </Button>
                </nav>
            </aside>

            <Separator class="my-6 lg:hidden" />

            <!-- Área de Conteúdo -->
            <div class="flex-1 md:max-w-2xl">
                
                <!-- Aba: Perfil -->
                <section v-if="currentTab === 'profile'" class="space-y-6 animate-in fade-in slide-in-from-right-4 duration-300">
                    <Heading
                        variant="small"
                        title="Informações do perfil"
                        description="Atualize seu nome e endereço de e-mail"
                    />

                    <Form
                        v-bind="ProfileController.update.form()"
                        class="space-y-6"
                        v-slot="{ errors, processing, recentlySuccessful }"
                    >
                        <div class="grid gap-2">
                            <Label for="name">Nome</Label>
                            <Input
                                id="name"
                                class="mt-1 block w-full"
                                name="name"
                                :default-value="user.name"
                                required
                                autocomplete="name"
                                placeholder="Nome completo"
                            />
                            <InputError class="mt-2" :message="errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Endereço de e-mail</Label>
                            <Input
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                name="email"
                                :default-value="user.email"
                                required
                                autocomplete="username"
                                placeholder="Endereço de e-mail"
                            />
                            <InputError class="mt-2" :message="errors.email" />
                        </div>

                        <div class="flex items-center gap-4">
                            <Button :disabled="processing">Salvar</Button>
                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-show="recentlySuccessful" class="text-sm text-neutral-600">Salvo.</p>
                            </Transition>
                        </div>
                    </Form>
                    
                    <Separator />
                    <DeleteUser />
                </section>

                <!-- Aba: Senha -->
                <section v-if="currentTab === 'password'" class="space-y-6 animate-in fade-in slide-in-from-right-4 duration-300">
                    <Heading
                        variant="small"
                        title="Atualizar senha"
                        description="Garanta que sua conta esteja usando uma senha longa e aleatória para manter a segurança"
                    />

                    <Form
                        v-bind="PasswordController.update.form()"
                        :options="{ preserveScroll: true }"
                        reset-on-success
                        :reset-on-error="['password', 'password_confirmation', 'current_password']"
                        class="space-y-6"
                        v-slot="{ errors, processing, recentlySuccessful }"
                    >
                        <div class="grid gap-2">
                            <Label for="current_password">Senha atual</Label>
                            <Input
                                id="current_password"
                                name="current_password"
                                type="password"
                                class="mt-1 block w-full"
                                autocomplete="current-password"
                                placeholder="Senha atual"
                            />
                            <InputError :message="errors.current_password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password">Nova senha</Label>
                            <Input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password"
                                placeholder="Nova senha"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirmar senha</Label>
                            <Input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password"
                                placeholder="Confirme a nova senha"
                            />
                            <InputError :message="errors.password_confirmation" />
                        </div>

                        <div class="flex items-center gap-4">
                            <Button :disabled="processing">Salvar senha</Button>
                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-show="recentlySuccessful" class="text-sm text-neutral-600">Salvo.</p>
                            </Transition>
                        </div>
                    </Form>
                </section>

                <!-- Aba: 2FA -->
                <section v-if="currentTab === '2fa'" class="space-y-6 animate-in fade-in slide-in-from-right-4 duration-300">
                    <Heading
                        variant="small"
                        title="Autenticação de Dois Fatores"
                        description="Gerencie as configurações de autenticação de dois fatores"
                    />

                    <div v-if="!twoFactorEnabled" class="flex flex-col items-start justify-start space-y-4">
                        <Badge variant="destructive">Desativado</Badge>
                        <p class="text-muted-foreground">
                            Ao ativar a autenticação de dois fatores, você será
                            solicitado a informar um PIN seguro durante o login.
                            Esse PIN pode ser obtido em um aplicativo compatível
                            com TOTP no seu celular.
                        </p>
                        <div>
                            <Button v-if="hasSetupData" @click="showSetupModal = true">
                                <ShieldCheck class="mr-2 h-4 w-4" />
                                Continuar configuração
                            </Button>
                            <Form
                                v-else
                                v-bind="enable.form()"
                                @success="showSetupModal = true"
                                v-slot="{ processing }"
                            >
                                <Button type="submit" :disabled="processing">
                                    <ShieldCheck class="mr-2 h-4 w-4" />
                                    Ativar 2FA
                                </Button>
                            </Form>
                        </div>
                    </div>

                    <div v-else class="flex flex-col items-start justify-start space-y-4">
                        <Badge variant="default">Ativado</Badge>
                        <p class="text-muted-foreground">
                            Com a autenticação de dois fatores ativada, você será
                            solicitado a informar um PIN seguro e aleatório durante
                            o login, que pode ser obtido no aplicativo compatível
                            com TOTP no seu celular.
                        </p>
                        
                        <TwoFactorRecoveryCodes />

                        <div class="relative inline">
                            <Form v-bind="disable.form()" v-slot="{ processing }">
                                <Button
                                    variant="destructive"
                                    type="submit"
                                    :disabled="processing"
                                >
                                    <ShieldBan class="mr-2 h-4 w-4" />
                                    Desativar 2FA
                                </Button>
                            </Form>
                        </div>
                    </div>

                    <TwoFactorSetupModal
                        v-model:isOpen="showSetupModal"
                        :requiresConfirmation="requiresConfirmation"
                        :twoFactorEnabled="twoFactorEnabled"
                    />
                </section>

                <!-- Aba: Aparência -->
                <section v-if="currentTab === 'appearance'" class="space-y-6 animate-in fade-in slide-in-from-right-4 duration-300">
                    <Heading
                        variant="small"
                        title="Configurações de aparência"
                        description="Atualize as configurações de aparência da sua conta"
                    />
                    <AppearanceTabs />
                </section>

            </div>
        </div>
    </div>
</template>
