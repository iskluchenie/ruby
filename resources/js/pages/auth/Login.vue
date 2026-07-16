<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import InputWithIcon from '@/components/InputWithIcon.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';


defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;

}>();

defineOptions({ layout: AuthLayout });
</script>

<template>
    <h1>{{ $t('Вход') }}</h1>
    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
        v-slot="{ errors, processing }"
    >
        <InputWithIcon
            name="email"
            :label="$t('E-mail')"
            :placeholder="$t('E-mail')"
            svgSprite="email"
            type="text"
            tabindex="2"
            :errors="errors"
            @clear-error="errors.email = ''"
        />
        <InputWithIcon
            name="password"
            :label="$t('Пароль')"
            :placeholder="$t('Пароль')"
            svgSprite="password"
            type="password"
            tabindex="3"
            :errors="errors"
            @clear-error="errors.password = ''"
        />
        <Label for="remember" class="check">
            <Checkbox id="remember" name="remember" :tabindex="4" />
            <span>{{ $t('Запомнить меня') }}</span>
        </Label>
        <div class="button-group">
            <Button
                type="submit"
                class="button-ruby"
                :tabindex="5"
                :disabled="processing"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                {{ $t('Отмена') }}
            </Button>
            <Button
                type="submit"
                class="button-ruby"
                :tabindex="5"
                :disabled="processing"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                {{ $t('Войти') }}
            </Button>
        </div>
    </Form>
    <div class="footnote">
        <div v-if="canResetPassword">
            <span>{{ $t('Забыли пароль') }}?</span>
            <Link :href="request()" :tabindex="5">
                {{ $t('Сброс пароля') }}
            </Link>
        </div>
        <div v-if="$page.props.auth.canRegister">
            <span>{{ $t('Нет учетной записи') }}?</span>
            <Link :href="register()" :tabindex="5">
                {{ $t('Регистирация') }}
            </Link>
        </div>
    </div>
</template>
