function formatarCampo(tipo, valor) {
    if (!valor) return '';

    switch (tipo) {
        case 'data':
            const data = new Date(valor);
            if (isNaN(data)) return valor; // Se não for data válida, retorna como veio
            return data.toLocaleDateString('pt-BR');

        case 'modalidade':
            switch (valor.toString()) {
                case '1': return 'Presencial';
                case '2': return 'Home Office';
                case '3': return 'Híbrido';
                default: return 'Outro';
            }

        case 'vinculo':
            switch (valor.toString()) {
                case '1': return 'CLT';
                case '2': return 'Estágio';
                case '3': return 'Temporário';
                case '4': return 'Freelancer';
                default: return 'Outro';
            }

        default:
            return valor;
    }
}

function goBack(fallbackUrl = '/') {
    const sameDomain = document.referrer && document.referrer.indexOf(window.location.hostname) !== -1;

    if (sameDomain && window.history.length > 1) {
        window.history.back();

        // Garante que, se não houver histórico real, redireciona após breve atraso
        setTimeout(() => {
            if (document.referrer === '' || window.location.href === document.referrer) {
                window.location.href = fallbackUrl;
            }
        }, 300);
    } else {
        // Sem histórico interno ou vindo de fora, redireciona diretamente
        window.location.href = fallbackUrl;
    }
}

