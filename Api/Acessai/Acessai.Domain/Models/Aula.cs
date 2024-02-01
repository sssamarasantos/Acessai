namespace Acessai.Domain.Models
{
    public class Aula : BaseModel
    {
        public string Nome { get; set; }
        public DateTime DataHoraCriacao { get; set; }
        public DateTime DataAlteracao { get; set; }
        public long IdProfessorDisciplina { get; set; }
    }
}
