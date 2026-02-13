export const useFormatDate = () => {
  const formatDate = (date: string | Date | null) => {
    if (!date) return '';
    
    const dateObj = new Date(date);
    
    return new Intl.DateTimeFormat('pt-BR', {
      day: '2-digit',
      month: '2-digit',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      timeZone: 'America/Sao_Paulo'
    }).format(dateObj);
  };

  return { formatDate };
};
