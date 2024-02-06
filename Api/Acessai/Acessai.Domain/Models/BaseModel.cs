using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Acessai.Domain.Models
{
    public class BaseModel
    {
        [Key]
        [Column("ID")]
        public long Id { get; set; }
    }
}
