namespace Acessai.Domain.Models
{
    public class ItemAula : BaseModel
    {
        public string Status { get; set; }
        public string Classificat { get; set; }
        public long IdAluno { get; set; }
        public long IdVideoaula { get; set; }
    }
}
