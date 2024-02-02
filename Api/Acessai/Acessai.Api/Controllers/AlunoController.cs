using Acessai.Domain.Interfaces.Repository;
using Acessai.Domain.Interfaces.Services;
using Acessai.Domain.Models;
using Microsoft.AspNetCore.Mvc;
using System.ComponentModel.DataAnnotations;

namespace Acessai.Api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AlunoController : ControllerBase
    {
        private readonly IAlunoService _alunoService;

        public AlunoController(IAlunoService alunoService)
        {
            _alunoService = alunoService;
        }

        [HttpGet("{id}")]
        public async Task<IActionResult> Get([FromRoute][Required] long id)
        {
            var response = await _alunoService.GetAlunoByIdAsync(id);

            if (response == null)
            {
                return NoContent();
            }

            return Ok(response);
        }
    }
}
