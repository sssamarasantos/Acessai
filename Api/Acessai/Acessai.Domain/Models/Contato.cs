namespace Acessai.Domain.Models
{
    public class Contato : BaseModel
    {
        public string Nome { get; set; }
        public string Email { get; set; }
        public string Assunto { get; set; }
        public string Mensagem { get; set; }
        public DateTime DataHoraMensagem { get; set; }
        public string Resposta { get; set; }
        public DateTime DataHoraResposta { get; set; }
    }
}
