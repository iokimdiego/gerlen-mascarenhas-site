/**
 * FORM.JS - Gerenciamento de Formulário
 * Solução frontend-only com redirecionamento para WhatsApp
 * Não requer backend PHP
 */

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contact-form");
    if (!form) return;

    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone");
    const messageInput = document.getElementById("message");
    const submitButton = form.querySelector('.form-submit-btn');

    const WHATSAPP_NUMBER = '5592992555753';

    form.addEventListener("submit", async function(event) {
        event.preventDefault();
        
        let valid = true;
        clearErrors();

        // Validar nome
        if (nameInput.value.trim().length < 3) {
            showError(nameInput, "Nome deve ter pelo menos 3 caracteres.");
            valid = false;
        }

        // Validar e-mail
        if (!validateEmail(emailInput.value)) {
            showError(emailInput, "Informe um endereço de e-mail válido.");
            valid = false;
        }

        // Validar telefone
        if (!validatePhone(phoneInput.value)) {
            showError(phoneInput, "Informe um telefone válido (mínimo 10 dígitos).");
            valid = false;
        }

        // Validar mensagem
        if (messageInput.value.trim().length < 10) {
            showError(messageInput, "A mensagem deve ter pelo menos 10 caracteres.");
            valid = false;
        }

        if (!valid) {
            return;
        }

        // Desabilitar botão durante envio
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Enviando...
        `;

        try {
            const messageLines = [
                '*Nova mensagem pelo site*',
                '',
                `*Nome:* ${nameInput.value.trim()}`,
                `*E-mail:* ${emailInput.value.trim()}`,
                `*Telefone:* ${phoneInput.value.trim()}`,
                '',
                `*Mensagem:*`,
                messageInput.value.trim()
            ];

            const whatsappText = encodeURIComponent(messageLines.join('\n'));
            const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${whatsappText}`;

            const popup = window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
            if (!popup) {
                window.location.href = whatsappUrl;
            }

            showSuccessMessage('Redirecionando para o WhatsApp...');
            form.reset();
        } catch (error) {
            console.error('Erro:', error);
            showErrorMessage('Não foi possível abrir o WhatsApp. Tente novamente.');
        } finally {
            // Reabilitar botão
            submitButton.disabled = false;
            submitButton.innerHTML = `
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Enviar Mensagem
            `;
        }
    });

    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    function validatePhone(phone) {
        const cleanPhone = phone.replace(/\D/g, '');
        return cleanPhone.length >= 10 && cleanPhone.length <= 11;
    }

    function showError(input, message) {
        const error = document.createElement("div");
        error.className = "error-message text-red-600 text-sm mt-1";
        error.textContent = message;
        input.parentNode.appendChild(error);
        input.classList.add('border-red-500');
    }

    function clearErrors() {
        const errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach(function(error) {
            error.remove();
        });
        
        const inputs = form.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.classList.remove('border-red-500');
        });
    }

    function showSuccessMessage(message) {
        const alert = document.createElement('div');
        alert.className = 'fixed top-24 right-6 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-fade-in';
        alert.innerHTML = `
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.remove();
        }, 5000);
    }

    function showErrorMessage(message) {
        const alert = document.createElement('div');
        alert.className = 'fixed top-24 right-6 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-fade-in';
        alert.innerHTML = `
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.remove();
        }, 5000);
    }
});
