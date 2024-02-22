using System.ComponentModel.DataAnnotations.Schema;

namespace Acessai.Domain.Models
{
    [Table("DISCIPLINA")]
    public class Disciplina : BaseModel
    {
        [Column("NOME")]
        public string Nome { get; set; }

        [Column("IMAGEM")]
        public string Imagem { get; set; }
    }
}
