namespace Acessai.Domain.Models
{
    public class Aluno : BaseModel
    {
        public string Nome { get; set; }
        public string Email { get; set; }
        public string Senha { get; set; }
        public string Assistencia { get; set; }
        public DateTime DataHoraCriacao { get; set; }
    }
}
