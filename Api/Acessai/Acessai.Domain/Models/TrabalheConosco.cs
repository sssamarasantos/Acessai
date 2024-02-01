namespace Acessai.Domain.Models
{
    public class TrabalheConosco : BaseModel
    {
        public string Nome { get; set; }
        public string Email { get; set; }
        public string Apresentacao { get; set; }
        public string Curriculo { get; set; }
        public DateTime DataHoraCriacao { get; set; }
        public string Resposta { get; set; }
        public DateTime DataHoraResposta { get; set; }
    }
}
