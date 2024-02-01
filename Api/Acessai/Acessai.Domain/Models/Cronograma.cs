namespace Acessai.Domain.Models
{
    public class Cronograma : BaseModel
    {
        public string Data { get; set; }
        public string Hora { get; set; }
        public DateTime DataHoraCriacao { get; set; }
        public DateTime DataHoraAlteracao { get; set; }
        public long IdAluno { get; set; }
        public long IdVideoaula { get; set; }
    }
}
