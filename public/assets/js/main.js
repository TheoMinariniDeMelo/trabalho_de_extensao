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
