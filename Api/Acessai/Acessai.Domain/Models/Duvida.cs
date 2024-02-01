namespace Acessai.Domain.Models
{
    public class Duvida : BaseModel
    {
        public string Mensagem { get; set; }
        public DateTime DataHoraMensagem { get; set; }
        public string Resposta { get; set; }
        public DateTime DataHoraResposta { get; set; }
        public long IdVideoaula { get; set; }
        public long IdAluno { get; set; }
        public long IdProfessor { get; set; }
    }
}
