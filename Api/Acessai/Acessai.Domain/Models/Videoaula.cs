namespace Acessai.Domain.Models
{
    public class Videoaula : BaseModel
    {
        public string Nome { get; set; }
        public string Video { get; set; }
        public DateTime DataHoraPostagem { get; set; }
        public DateTime DataHoraAlteracao { get; set; }
        public string Assistencia { get; set; }
        public string Arquivo { get; set; }
        public string Texto { get; set; }
        public long IdAula { get; set; }
    }
}
